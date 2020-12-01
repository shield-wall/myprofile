<?php

namespace App\Controller\Profile;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skill", name="skill_")
 */
class SkillController extends AbstractController
{
    /**
     * @Route(name="index", methods={"GET"})
     */
    public function indexAction(SkillRepository $skillRepository)
    {
        $skills = $skillRepository->findBy(['user' => $this->getUser()]);

        return $this->render('profile/skill/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $skill = new Skill();
        $skill->setUser($this->getUser());
        $form = $this->createForm('App\Form\SkillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_skill_index');
        }

        return $this->render('profile/skill/save.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @Security("user == skill.getUser()")
     */
    public function editAction(Request $request, Skill $skill)
    {
        $form = $this->createForm('App\Form\SkillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_skill_index');
        }

        return $this->render('profile/skill/save.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == skill.getUser()")
     */
    public function deleteAction(Request $request, Skill $skill)
    {
        if ($this->isCsrfTokenValid('delete' . $skill->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skill);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_skill_index');
    }
}

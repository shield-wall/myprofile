<?php

namespace App\Controller\Profile;

use App\Entity\EntityInterface;
use App\Entity\HasUserInterface;
use App\Entity\User;
use App\Repository\OwnerDataRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractCrudController extends AbstractController
{
    protected const PREFIX = null;

    //TODO check other solution to not inject entityManager here.
    public function __construct(readonly private EntityManagerInterface $entityManager)
    {
    }

    public function index(OwnerDataRepositoryInterface $repository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render(sprintf('profile/%s.html.twig', static::PREFIX), [
            'data' => $repository->getOwnerData($user)
        ]);
    }

    public function save(Request $request, string $formTypeClass, HasUserInterface $object): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $object->setUser($user);
        $form = $this->createForm($formTypeClass, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($object);
            $this->entityManager->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute(sprintf('profile_%s_index', static::PREFIX));
        }

        return $this->render('profile/save.html.twig', [
            'form' => $form->createView(),
            'back_path' => sprintf('profile_%s_index', static::PREFIX),
            'title' => sprintf('form.%s.head.title', static::PREFIX),
        ]);
    }

    public function delete(Request $request, EntityInterface $entity): Response
    {
        /** @var string $token */
        $token = $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete_' . $entity->getId(), $token)) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute(sprintf('profile_%s_index', static::PREFIX));
    }
}

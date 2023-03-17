import title from "./components/title";
import {Section} from "../../models/section";
import boxDetail from "./components/box-detail";
import {Resume} from "../../models/resume";
import certifications from "./components/certifications";
import {Icons} from "../../components/icons";

export default function sectionDetail(resume: Resume) {
    return `
    <div class="content is-normal">

    <div class="has-text-justified">
        <section class="mt-4">
            <h4>
                <span class="icon-text">
                    <span class="icon">
                        ${Icons['fileDescription']}
                    </span>
                    <span>About</span>
                </span>
            </h4>
            <div>
                ${resume.getBasic().getAbout()}
            </div>
        </section>

            <section class="mt-4">
                ${title(new Section('Experience'))}
                ${
                    resume.getExperiences()
                        .map((experience) => boxDetail(experience))
                        .join('')
                }
            </section>
            
           <section class="mt-4">
                ${title(new Section('Educations'))}
                ${
                    resume.getEducations()
                        .map((education) => boxDetail(education))
                        .join('')
                }
            </section>
    </div>

    <section class="mt-4">
        ${certifications(resume.getCertifications())}
    </section>

</div>
    `;
}
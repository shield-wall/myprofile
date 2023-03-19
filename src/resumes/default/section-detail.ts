import boxDetail from "./components/box-detail";
import {Resume} from "../../models/resume";
import certifications from "./components/certifications";
import {Icons} from "../../components/icons";
import {markdown} from "../../components/markdown";

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
                ${markdown(resume.getBasic().getAbout())}
            </div>
        </section>

            <section class="mt-4">
                ${
                    resume.getExperiences()
                        .map((experience) => boxDetail(experience))
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
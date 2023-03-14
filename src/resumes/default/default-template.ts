import {ResumeTemplateInterface} from "../contracts/resume-template";
import 'bulma/bulma.sass';
import sectionProfile from "./section-profile";
import {ResumeInterface} from "../../models/resume";

export default class DefaultTemplate implements ResumeTemplateInterface {
    constructor(private resume: ResumeInterface) {
        this.resume = resume;
    }

    template(): string {
        return `
    <div class="columns">
        <div class="column is-4">
            ${sectionProfile(this.resume)}
        </div>

        <div class="column is-8">
            {% include '@!Curriculum/cv01/section/section_detail.html.twig' %}
        </div>
    </div>
    `
    }
};
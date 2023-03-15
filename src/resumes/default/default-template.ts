import {ResumeTemplateInterface} from "../contracts/resume-template";
import 'bulma/bulma.sass';
import sectionProfile from "./section-profile";
import {Resume} from "../../models/resume";
import sectionDetail from "./section-detail";

export default class DefaultTemplate implements ResumeTemplateInterface {
    constructor(private resume: Resume) {
        this.resume = resume;
    }

    template(): string {
        return `
    <div class="columns">
        <div class="column is-4">
            ${sectionProfile(this.resume)}
        </div>

        <div class="column is-8">
            ${sectionDetail(this.resume)}
        </div>
    </div>
    `
    }
};
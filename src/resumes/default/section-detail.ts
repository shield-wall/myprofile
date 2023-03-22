import { Resume } from "../../models/resume";
import { sections } from "./components/sections";

export default function sectionDetail(resume: Resume) {
	return `
    <div class="content is-normal">
        ${sections(resume.getSectionsOne())} 
    </div>
    `;
}

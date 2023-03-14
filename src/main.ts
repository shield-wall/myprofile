import resume from "./resumes/resume";
import defaultTemplate from "./resumes/default/default-template";
import {ResumeRepository} from "./repository/__mocks__/resume-repository";
// TODO add variable to import from data
//  import {ResumeRepository} from "./repository/resume-repository";

let repository = new ResumeRepository();
let template = new defaultTemplate(repository.findCurrentResume());

resume(document.querySelector<HTMLDivElement>('#app')!, template);

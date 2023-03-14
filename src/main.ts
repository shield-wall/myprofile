import resume from "./resumes/resume";
import defaultTemplate from "./resumes/default/default-template";
 import {ResumeRepository} from "./repository/resume-repository";

let repository = new ResumeRepository();
let template = new defaultTemplate(repository.findCurrentResume());

resume(document.querySelector<HTMLDivElement>('#app')!, template);

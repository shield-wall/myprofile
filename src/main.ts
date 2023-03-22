import resume from "./resumes/resume";
import defaultTemplate from "./resumes/default/default-template";
import { ResumeRepository } from "./repository/resume-repository";

const repository = new ResumeRepository();
const template = new defaultTemplate(repository.findCurrentResume());

resume(document.querySelector<HTMLDivElement>("#app")!, template);

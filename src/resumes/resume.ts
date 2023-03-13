import {ResumeTemplateInterface} from "./contracts/resume-template";

export default function resume(element: HTMLDivElement, resumeTemplate: ResumeTemplateInterface): void
{
    element.innerHTML = resumeTemplate.template();
}

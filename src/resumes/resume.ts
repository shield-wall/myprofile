import {ResumeTemplateInterface} from "./resume-template-interface";

export default function resume(element: HTMLDivElement, resumeTemplate: ResumeTemplateInterface): void
{
    element.innerHTML = resumeTemplate.template();
}

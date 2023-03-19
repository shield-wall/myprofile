import {ResumeType} from "../types/resume-type";
import {Basic} from "./basic";
import {Section} from "./section";

export class Resume
{
    private readonly basic: Basic;
    private readonly sectionsOne: Section[];
    private readonly sectionsTwo: Section[];

    constructor(resumeType: ResumeType) {
        this.basic = new Basic(resumeType.basic);

        this.sectionsOne = resumeType
            .sectionOne
            .map((sectionType) => new Section(sectionType));

        this.sectionsTwo = resumeType
            .sectionTwo
            .map((sectionType) => new Section(sectionType));
    }

    getBasic(): Basic {
        return this.basic
    }

    getSectionsTwo(): Section[] {
        return this.sectionsTwo;
    }

    getSectionsOne(): Section[] {
        return this.sectionsOne;
    }
}
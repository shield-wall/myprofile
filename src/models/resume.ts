import {Education} from "./education";
import {Experience} from "./experience";
import {ResumeType} from "../types/resume-type";
import {Basic} from "./basic";
import {SimpleList} from "./simple-list";

export class Resume
{
    private readonly basic: Basic;
    private readonly skills: string[];
    private readonly simpleLists: SimpleList[];
    private readonly educations: Education[];
    private readonly experiences: Experience[];

    constructor(resumeType: ResumeType) {
        this.basic = new Basic(resumeType.basic);
        this.skills = resumeType.skills;

        this.simpleLists = resumeType
            .simpleLists
            .map((simpleList) => new SimpleList(simpleList));

        this.educations = resumeType
            .educations
            .map((education) => new Education(education));

        this.experiences = resumeType
            .experiences
            .map((experience) => new Experience(experience));
    }

    getBasic(): Basic {
        return this.basic
    }

    getSkills(): string[] {
        return this.skills;
    }

    getEducations(): Education[] {
        return this.educations;
    }

    getExperiences(): Experience[] {
        return this.experiences;
    }

    getSimpleLists(): SimpleList[] {
        return this.simpleLists;
    }
}
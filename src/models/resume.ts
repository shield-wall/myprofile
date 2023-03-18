import {Education} from "./education";
import {Experience} from "./experience";
import {ResumeType} from "../types/resume-type";
import {Basic} from "./basic";
import {Certification} from "./certification";
import {Section} from "./section";

export class Resume
{
    private readonly basic: Basic;
    private readonly skills: string[];
    private readonly educations: Education[];
    private readonly experiences: Experience[];
    private readonly certifications: Certification[];
    private readonly sections: Section[];

    constructor(resumeType: ResumeType) {
        this.basic = new Basic(resumeType.basic);
        this.skills = resumeType.skills;

        this.educations = resumeType
            .educations
            .map((educationType) => new Education(educationType));

        this.experiences = resumeType
            .experiences
            .map((experienceType) => new Experience(experienceType));

        this.certifications = resumeType
            .certifications
            .map((certificationType) => new Certification(certificationType));

        this.sections = resumeType
            .sectionTwo
            .map((sectionType) => new Section(sectionType));
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

    getCertifications(): Certification[] {
        return this.certifications;
    }

    getSections(): Section[] {
        return this.sections;
    }
}
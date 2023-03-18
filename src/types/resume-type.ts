import {BasicType} from "./basic-type";
import {EducationType} from "./education-type";
import {ExperienceType} from "./experience-type";
import {CertificationType} from "./certification-type";
import {SectionType} from "./section-type";

export type ResumeType = {
        basic: BasicType;
        skills: string[];
        educations: EducationType[];
        experiences: ExperienceType[];
        certifications: CertificationType[];

        sectionTwo: SectionType[];
}
import {BasicType} from "./basic-type";
import {SectionType} from "./section-type";

export type ResumeType = {
        basic: BasicType;
        sectionOne: SectionType[];
        sectionTwo: SectionType[];
}
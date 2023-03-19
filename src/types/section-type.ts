import {SimpleListType} from "./simple-list-type";
import {EducationType} from "./education-type";
import {TagType} from "./tag-type";
import {ContentType} from "./content-type";
import {ExperienceType} from "./experience-type";
import {CertificationType} from "./certification-type";

export type SectionType = {
    title: string | null;
    icon: string | null;
    children: (
        SimpleListType
        | EducationType
        | ExperienceType
        | CertificationType
        | TagType
        | ContentType
        )[];
}
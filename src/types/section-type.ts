import {SimpleListType} from "./simple-list-type";
import {EducationType} from "./education-type";

export type SectionType = {
    title: string|null;
    icon: string|null;
    layout: string;
    children: (SimpleListType|EducationType)[];

}
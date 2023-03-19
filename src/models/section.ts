import {SectionType} from "../types/section-type";
import {SimpleList} from "./simple-list";
import {Education} from "./education";
import {SimpleListType} from "../types/simple-list-type";
import {EducationType} from "../types/education-type";
import {TagType} from "../types/tag-type";
import {Tag} from "./tag";
import {OptionalTitleInterface} from "./contracts/title-interface";
import {OptionalIconInterface} from "./contracts/icon-interface";
import {Content} from "./content";
import {ContentType} from "../types/content-type";
import {ExperienceType} from "../types/experience-type";
import {Experience} from "./experience";
import {Certification} from "./certification";
import {CertificationType} from "../types/certification-type";

export class Section implements OptionalTitleInterface, OptionalIconInterface {
    private readonly title: string | null;
    private readonly icon: string | null;
    private readonly children: (
        SimpleList
        | Education
        | Experience
        | Certification
        | Tag
        | Content
        )[];

    constructor(
        sectionType: SectionType
    ) {
        this.title = sectionType.title;
        this.icon = sectionType.icon;
        this.children = sectionType
            .children
            .map((item: SimpleListType
                | EducationType
                | ExperienceType
                | CertificationType
                | TagType
                | ContentType
            ) => {
                if ('degree' in item)
                    return new Education(item);

                if ('company' in item)
                    return new Experience(item);

                if ('tag' in item)
                    return new Tag(item);

                if ('content' in item)
                    return new Content(item);

                if ('photoUrl' in item)
                    return new Certification(item);

                return new SimpleList(item);
            });
    }

    getTitle(): string | null {
        return this.title;
    }

    getIcon(): string | null {
        return this.icon;
    }

    getChildren(): (
        SimpleList
        | Education
        | Experience
        | Certification
        | Tag
        | Content
        )[] {
        return this.children;
    }
}
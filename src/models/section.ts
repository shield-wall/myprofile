import {SectionType} from "../types/section-type";
import {SimpleList} from "./simple-list";
import {Education} from "./education";
import {SimpleListType} from "../types/simple-list-type";
import {EducationType} from "../types/education-type";

export class Section {
    private readonly title: string | null;
    private readonly icon: string | null;
    private readonly layout: string;
    private readonly children: (SimpleList | Education)[];

    constructor(
        sectionType: SectionType
    ) {
        this.title = sectionType.title;
        this.icon = sectionType.icon;
        this.layout = sectionType.layout;
        this.children = sectionType
            .children
            .map((item: SimpleListType | EducationType) => {
                if ('degree' in item)
                    return new Education(item);

                return new SimpleList(item);
            });
    }

    getTitle(): string | null {
        return this.title;
    }

    getIcon(): string | null {
        return this.icon;
    }

    getLayout(): string {
        return this.layout;
    }

    getChildren(): (SimpleList | Education)[] {
        return this.children;
    }
}
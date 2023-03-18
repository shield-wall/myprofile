import {TitleInterface} from "./contracts/title-interface";
import {IconInterface} from "./contracts/icon-interface";

export class Section implements TitleInterface, IconInterface
{
    constructor(
        private readonly title: string,
        private readonly icon: string,
    ) {
        this.title = title;
        this.icon = icon;
    }
    getTitle(): string {
        return this.title
    }

    getIcon(): string {
        return this.icon;
    }
}
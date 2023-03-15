import {TitleInterface} from "./title-interface";

export class Section implements TitleInterface
{
    constructor(
        private readonly title: string,
    ) {
        this.title = title;
    }
    getTitle(): string {
        return this.title
    }
}
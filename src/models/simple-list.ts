import {SimpleListType} from "../types/simple-list-type";
import {TitleInterface} from "./title-interface";

export class SimpleList implements TitleInterface
{
    private readonly title: string;
    private readonly icon: string;

    constructor(simpleListType: SimpleListType) {
        this.title = simpleListType.title;
        this.icon = simpleListType.icon;
    }

    getTitle(): string {
        return this.title;
    }

    // TODO use IconEnum
    getIcon(): string {
        return this.icon;
    }
}
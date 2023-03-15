import {TitleInterface} from "./title-interface";
import {LanguageType} from "../types/language-type";

export class Language implements TitleInterface
{
    private readonly title: string;
    private readonly level: string;

    constructor(languageType: LanguageType)
    {
        this.title = languageType.title;
        this.level = languageType.level;
    }

    getTitle(): string
    {
        return this.title;
    }

    getLevel(): string
    {
        return this.level;
    }
}
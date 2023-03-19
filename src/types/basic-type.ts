import {LanguageType} from "./language-type";

export type BasicType = {
    firstName: string|null;
    lastName: string|null;
    photoUrl: string|null;
    position: string|null;
    about: string;
    languages: LanguageType[];
}
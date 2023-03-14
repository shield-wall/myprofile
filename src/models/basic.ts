import {LanguageInterface} from "./language";

export interface BasicInterface {
    firstName: string|null;
    lastName: string|null;
    photoUrl: string|null;
    position: string|null;
    about: string|null;
    languages: LanguageInterface[];
}
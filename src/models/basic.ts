import {Language} from "./language";
import {BasicType} from "../types/basic-type";
import {PhotoUrlInterface} from "./contracts/photo-url-interface";

export class Basic implements PhotoUrlInterface
{
    private readonly firstName: string|null;
    private readonly lastName: string|null;
    private readonly photoUrl: string|null;
    private readonly position: string|null;
    private readonly about: string;
    private readonly languages: Language[];

    constructor(basicType: BasicType) {
        this.firstName = basicType.firstName;
        this.lastName = basicType.lastName;
        this.photoUrl = basicType.photoUrl;
        this.position = basicType.position;
        this.about = basicType.about;
        this.languages = basicType
            .languages
            .map((language) => new Language(language));
    }

    getFirstName(): string|null {
        return this.firstName;
    }

    getLastName(): string|null {
        return this.lastName;
    }

    getPhotoUrl(): string|null {
        return this.photoUrl;
    }

    getPosition(): string|null {
        return this.position;
    }

    getAbout(): string {
        return this.about;
    }

    getLanguages(): Language[] {
        return this.languages;
    }
}

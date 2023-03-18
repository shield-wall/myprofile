import {DetailSectionInterface} from "./contracts/detail-section-interface";
import {ExperienceType} from "../types/experience-type";

export class Experience implements DetailSectionInterface
{
    private readonly company: string;
    private readonly position: string;
    private readonly timePeriod: string;
    private readonly description: string;

    constructor(experienceType: ExperienceType)
    {
        this.company = experienceType.company;
        this.position = experienceType.position;
        this.timePeriod = experienceType.timePeriod;
        this.description = experienceType.description;
    }

    getTitle(): string {
        return this.position;
    }

    getInstitution(): string {
        return this.company;
    }

    getTimePeriod(): string {
        return this.timePeriod;
    }

    getDescription(): string {
        return this.description;
    }
}
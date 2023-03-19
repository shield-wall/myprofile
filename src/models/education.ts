import {DetailSectionInterface} from "./contracts/detail-section-interface";
import {EducationType} from "../types/education-type";

export class Education implements DetailSectionInterface
{
    private readonly description: string;
    private readonly institution: string;
    private readonly timePeriod: string;
    private readonly degree: string;

    constructor(educationType: EducationType)
    {
        this.description = educationType.description;
        this.institution = educationType.institution;
        this.timePeriod = educationType.timePeriod;
        this.degree = educationType.degree;
    }

    getContent(): string {
        return this.description;
    }

    getInstitution(): string {
        return this.institution;
    }

    getTimePeriod(): string {
        return this.timePeriod;
    }

    getTitle(): string {
        return this.degree;
    }
}
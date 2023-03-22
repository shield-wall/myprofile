import { DetailSectionInterface } from "./contracts/detail-section-interface";
import { ExperienceType } from "../types/experience-type";

export class Experience implements DetailSectionInterface {
	private readonly company: string;
	private readonly position: string;
	private readonly timePeriod: string;
	private readonly description: string;
	private readonly photoUrl: string | null;
	private readonly website: string | null;

	constructor(experienceType: ExperienceType) {
		this.company = experienceType.company;
		this.position = experienceType.position;
		this.timePeriod = experienceType.timePeriod;
		this.description = experienceType.description;
		this.photoUrl = experienceType.photoUrl;
		this.website = experienceType.website;
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

	getContent(): string {
		return this.description;
	}

    getPhotoUrl(): string | null {
        return this.photoUrl;
    }

    getWebsite(): string | null {
        return this.website;
    }
}

import { EducationType } from "../types/education-type";

export class Education {
	private readonly institution: string;
	private readonly timePeriod: string;
	private readonly degree: string;

	constructor(educationType: EducationType) {
		this.institution = educationType.institution;
		this.timePeriod = educationType.timePeriod;
		this.degree = educationType.degree;
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

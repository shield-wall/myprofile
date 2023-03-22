import { PhotoUrlInterface } from "./contracts/photo-url-interface";
import { CertificationType } from "../types/certification-type";
import { TitleInterface } from "./contracts/title-interface";

export class Certification implements PhotoUrlInterface, TitleInterface {
	private readonly title: string;
	private readonly photoUrl: string | null;
	private readonly timePeriod: string;
	private readonly website: string | null;

	constructor(certificationType: CertificationType) {
		this.title = certificationType.title;
		this.photoUrl = certificationType.photoUrl;
		this.timePeriod = certificationType.timePeriod;
		this.website = certificationType.website;
	}

	getTitle(): string {
		return this.title;
	}

	getPhotoUrl(): string | null {
		return this.photoUrl;
	}

	getTimePeriod(): string {
		return this.timePeriod;
	}

	getWebsite(): string | null {
		return this.website;
	}
}

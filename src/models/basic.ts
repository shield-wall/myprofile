import { BasicType } from "../types/basic-type";
import { PhotoUrlInterface } from "./contracts/photo-url-interface";

export class Basic implements PhotoUrlInterface {
	private readonly firstName: string | null;
	private readonly lastName: string | null;
	private readonly photoUrl: string | null;
	private readonly position: string | null;

	constructor(basicType: BasicType) {
		this.firstName = basicType.firstName;
		this.lastName = basicType.lastName;
		this.photoUrl = basicType.photoUrl;
		this.position = basicType.position;
	}

	getFirstName(): string | null {
		return this.firstName;
	}

	getLastName(): string | null {
		return this.lastName;
	}

	getPhotoUrl(): string | null {
		return this.photoUrl;
	}

	getPosition(): string | null {
		return this.position;
	}
}

import { ContentType } from "../types/content-type";
import { ContentInterface } from "./contracts/content-interface";

export class Content implements ContentInterface {
	private readonly content: string;

	constructor(contentType: ContentType) {
		this.content = contentType.content;
	}

	getContent(): string {
		return this.content;
	}
}

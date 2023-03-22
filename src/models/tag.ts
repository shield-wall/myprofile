import { TagType } from "../types/tag-type";

export class Tag {
	private readonly tag: string | string[];

	constructor(tagType: TagType) {
		this.tag = tagType.tag;
	}

	getTag(): string | string[] {
		return this.tag;
	}
}

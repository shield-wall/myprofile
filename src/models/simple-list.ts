import { SimpleListType } from "../types/simple-list-type";
import { TitleInterface } from "./contracts/title-interface";
import { IconInterface } from "./contracts/icon-interface";

export class SimpleList implements TitleInterface, IconInterface {
	private readonly title: string;
	private readonly icon: string;

	constructor(simpleListType: SimpleListType) {
		this.title = simpleListType.title;
		this.icon = simpleListType.icon;
	}

	getTitle(): string {
		return this.title;
	}

	getIcon(): string {
		return this.icon;
	}
}

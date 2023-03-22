import { ContentInterface } from "./content-interface";

export interface DetailSectionInterface extends ContentInterface {
	getTitle(): string;
	getInstitution(): string;
	getTimePeriod(): string;
}

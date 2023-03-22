import { ContentInterface } from "./content-interface";
import {PhotoUrlInterface} from "./photo-url-interface";

export interface DetailSectionInterface extends ContentInterface, PhotoUrlInterface {
	getTitle(): string;
	getInstitution(): string;
	getTimePeriod(): string;
    getWebsite(): string | null;
}

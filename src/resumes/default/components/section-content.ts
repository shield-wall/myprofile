import {ContentInterface} from "../../../models/contracts/content-interface";
import {markdown} from "../../../components/markdown";

export function sectionContent(content: ContentInterface): string {
    return markdown(content.getContent());
}
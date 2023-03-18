import {Section} from "../../../models/section";
import {Icons} from "../../../components/icons";

export default function title(section: Section): string
{
    if (section.getTitle() === null || section.getIcon() === null)
        return '';

    // @ts-ignore
    let _icon = Icons[section.getIcon()]
    return `
            <div class="is-size-5 has-text-weight-bold">
                <span class="icon-text">
                    <span class="icon">${_icon}</span>
                    <span>${section.getTitle()}</span>
                </span>
            </div>
    `;
}
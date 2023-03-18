import {Section} from "../../../models/section";

export default function title(section: Section): string
{
    return `
                <h4>
                    <span class="icon-text">
                        <span class="icon">
                            ${section.getIcon()}
                        </span>
                        <span>${section.getTitle()}</span>
                    </span>
                </h4>
    `;
}
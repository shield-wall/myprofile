import {Section} from "../../../models/section";
import {SimpleList} from "../../../models/simple-list";
import {Education} from "../../../models/education";
import {sectionSimpleList} from "./section-simple-list";
import {sectionShortDetail} from "./section-short-detail";
import title from "./title";

export function sections(sections: Section[]): string
{
    let content = '';
    sections.forEach((section: Section) => {
        content += `<div class="column">
                        <div class="mb-1">
                            ${title(section)} 
                        </div>
                        ${_section(section)}
                </div>`;
    });

    return content;
}

function _section(section: Section) {
    let content = '';
    section.getChildren().forEach((item: SimpleList|Education) => {
        if (item instanceof SimpleList)
            content += `<div>${sectionSimpleList(item)}</div>`;

        if(item instanceof Education)
            content += `<div>${sectionShortDetail(item)}</div>`
    })

    return content;
}

import {DetailSectionInterface} from "../../../models/contracts/detail-section-interface";

export default function boxDetail(detailSection: DetailSectionInterface): string
{
    return `
    <div class="block">
    <div>
        <div class="is-flex is-justify-content-space-between">
            <div>
                <strong>${detailSection.getTitle()}</strong> (${detailSection.getInstitution()})
            </div>
            <div>${detailSection.getTimePeriod()}</div>
        </div>
    </div>
    <div class="mt-2">${detailSection.getDescription().replace (/\n/g, "<br />")}</div>
</div>`;
}
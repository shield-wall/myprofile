import {DetailSectionInterface} from "../../../models/contracts/detail-section-interface";
import {markdown} from "../../../components/markdown";

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
    <div class="mt-2">${markdown(detailSection.getDescription())}</div>
</div>`;
}
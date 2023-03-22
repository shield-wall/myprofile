import { Education } from "../../../models/education";

export function sectionEducations(education: Education): string {
	return `
            <div>
                <div class="is-size-6 has-text-weight-bold">${education.getTitle()}</div>
                <div>${education.getInstitution()}</div>
                <div>${education.getTimePeriod()}</div>
            </div>
    `;
}

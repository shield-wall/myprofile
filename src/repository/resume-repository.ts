import resumeJson from "../../data/json/data.json";
import { Resume } from "../models/resume";

export class ResumeRepository {
	findCurrentResume(): Resume {
		return new Resume(resumeJson);
	}
}

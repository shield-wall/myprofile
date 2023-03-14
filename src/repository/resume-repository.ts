import resumeJson from '../../data/json/data.json'
import {ResumeInterface} from "../models/resume";

export class ResumeRepository
{
    findCurrentResume(): ResumeInterface
    {
        let resume: ResumeInterface =  resumeJson;

        return resume;
    }
}
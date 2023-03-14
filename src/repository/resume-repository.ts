import fs from 'fs'
import YAML from 'yaml'
import {BasicInterface} from "../models/basic";

export class ResumeRepository
{
    findCurrentUser(): BasicInterface
    {
        const file = fs.readFileSync('../data/user.yaml', 'utf8')
        return YAML.parse(file)
    }
}
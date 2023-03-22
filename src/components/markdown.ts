import { marked } from "marked";

export function markdown(content: string): string {
	return marked.parse(content);
}

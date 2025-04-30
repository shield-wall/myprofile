import { expect, test, describe } from 'vitest'
import mainCssPath from './main-css-path';

describe('Choose main css path', () => {
    test('undefined template', () => {
      expect(mainCssPath()).toBe('resume-default/main.scss');
    });

    test('passing template', () => {
      expect(mainCssPath('resume-simple')).toBe('resume-simple/main.scss');
    });

    test('Accept list of templates', () => {
      expect(() => mainCssPath('fake-template')).toThrow('resume fake-template does not exist.');
    });
})

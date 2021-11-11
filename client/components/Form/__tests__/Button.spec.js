import { shallowMount } from '@vue/test-utils'
import Button from '../Button'

describe('Button', () => {
  it('can get the label value', () => {
    const wrapper = shallowMount(Button, {
      slots: {
        default: 'foo'
      }
    })

    expect(wrapper.find('button').text()).toBe('foo')
  })
})

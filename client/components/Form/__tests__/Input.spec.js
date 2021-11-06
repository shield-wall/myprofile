import { shallowMount } from '@vue/test-utils'
import Input from '../Input'

describe('Input component', () => {
  test('props are working properly.', () => {
    const wrapper = shallowMount(Input, {
      propsData: {
        placeholder: 'foo',
        type: 'bar',
        label: 'baz'
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })

  test('default props.', () => {
    const wrapper = shallowMount(Input, {
      propsData: {
        placeholder: 'foo',
        label: 'baz'
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })
})

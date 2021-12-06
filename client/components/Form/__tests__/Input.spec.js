import { shallowMount } from '@vue/test-utils'
import Input from '../Input'
import { ConstraintViolationListException } from '~/exception/constraint-violation-list.exception'
import json from '~/static/__mocks__/violations'

describe('Input component', () => {
  test('props are working properly.', () => {
    const wrapper = shallowMount(Input, {
      propsData: {
        placeholder: 'foo',
        type: 'bar',
        label: 'baz',
        violations: []
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })

  test('default props.', () => {
    const wrapper = shallowMount(Input, {
      propsData: {
        placeholder: 'foo',
        label: 'baz',
        violations: []
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('can see error message.', () => {
    const wrapper = shallowMount(Input, {
      propsData: {
        placeholder: 'foo',
        label: 'baz',
        violations: new ConstraintViolationListException(JSON.parse(json)).violations
      }
    })

    expect(wrapper.find('#violations').text()).toBe('baz message.')
  })
})

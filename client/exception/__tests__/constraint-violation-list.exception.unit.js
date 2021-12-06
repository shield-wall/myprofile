import { ConstraintViolationListException } from '../constraint-violation-list.exception'
import json from '~/static/__mocks__/violations'

describe('Check constraint violation list exception.', () => {
  it('can get violations list by property.', () => {
    const constraint = new ConstraintViolationListException(JSON.parse(json))
    expect(constraint.violations.length).toEqual(1)
    expect(constraint.getViolationsBy('email')[0].message).toBe('baz message.')
    expect(constraint.getViolationsBy('fake_field')).toEqual([])
  })
})

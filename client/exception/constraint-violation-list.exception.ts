import { ViolationInterface, ViolationsInterface } from '~/exception/contracts/violation.interface'

export class ConstraintViolationListException implements ViolationsInterface {
  violations: ViolationInterface[] = []

  constructor (init?: Partial<ViolationsInterface>) {
    Object.assign(this, init)
  }

  public getViolationsBy (property: string): ViolationInterface[] {
    return this.violations.filter((violation: ViolationInterface) => violation.propertyPath == property)
  }
}

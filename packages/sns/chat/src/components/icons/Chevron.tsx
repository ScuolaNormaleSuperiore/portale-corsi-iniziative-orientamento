import clsx from 'clsx';
import { IconProps } from '../../types/icon';
import { FC } from 'react';

const Chevron: FC<IconProps> = ({ className, size = 24, color, ...props }) => {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={size}
      height={size}
      viewBox="0 0 24 24"
      fill="none"
      stroke={color || 'currentColor'}
      strokeWidth="1"
      strokeLinecap="round"
      strokeLinejoin="round"
      className={clsx('stroke-primary', className)}
      aria-hidden="true"
      {...props}
    >
      <path
        d="M12.0004 15.2L6.40039 9.60005L7.10039 8.80005L12.0004 13.7L16.9004 8.80005L17.6004 9.60005L12.0004 15.2Z"
        fill="currentColor"
      />
    </svg>
  );
};

const ChevronUp: FC<IconProps> = (props) => {
  return <Chevron {...props} className={clsx('rotate-180', props.className)} />;
};

const ChevronDown: FC<IconProps> = (props) => {
  return <Chevron {...props} />;
};

export { ChevronUp, ChevronDown };

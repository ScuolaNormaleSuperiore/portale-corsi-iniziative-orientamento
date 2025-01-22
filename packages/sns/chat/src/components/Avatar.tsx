import clsx from 'clsx';
import { AvatarProps } from '../types/avatar';

const Avatar: React.FC<AvatarProps> = ({ role = 'assistant' }) => {
  return (
    <div
      className={clsx(
        'w-10 h-10 min-w-10 min-h-10 rounded-full bg-secondary-lighter self-start sticky top-0',
      )}
    />
  );
};

export default Avatar;
